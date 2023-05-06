<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Response;

class AdminController extends Controller
{

    public function saveAdmin(Request $request)
    {
        $admin = User::all()->first();

        $email = $request->email;
        $username = $request->username;
        $password = $request->password;

        if ($email != null) {
            $admin->update([
                'email' => $email,
            ]);
        }

        if ($username != null) {
            $admin->update([
                'username' => $username,
            ]);
        }

        if ($password != null && strlen($password) > 8) {
            $admin->update([
                'password' => Hash::make($password),
            ]);
        }

        return response()->json($admin);
    }

    public function getAdmin()
    {
        $admin = User::all()->first();

        return response()->json($admin);
    }

    public function getEmailToken()
    {
        // Cookie::queue('emailToken', Str::random(16), 5);
        $cookie = cookie('emailToken', Str::random(), 5, null, null, null, false);
        $response = new Response();
        $response->withCookie($cookie);
        return $response;
    }

    public function sendEmail(Request $request)
    {

        $emailToken = Cookie::get('emailToken');

        if (!isset($emailToken) || $emailToken == null) {
            return response()->json(['status' => 'false']);
        }

        if ($request->cookie('emailToken') == null || $request->cookie('emailToken') != $emailToken) {
            return response()->json(['status' => 'false']);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $number = $request->input('number');
        $description = $request->input('description');
        $datetime = $request->input('datetime');
        $images = $request->input('images');

        if (!isset($name) && !isset($email) && !isset($phone) && !isset($datetime)) {
            return response()->json(['status' => 'false']);
        }


        $mail = new PHPMailer(true);

        $mail->isSMTP();

        // Enable SMTP authentication
        $mail->SMTPAuth = true;
        $mail->AuthType = 'LOGIN';
        $mail->Username = 'no-replay@propako.ru';
        $mail->Password = 'EXNkxmMsjYBPKwszxsoktx6b';

        $mail->Host = 'smtp.yandex.com';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('no-replay@propako.ru', 'Your Name');
        $mail->addAddress('nurlitan.berikbol@yandex.ru', 'Новая Заявка');
        $mail->Subject = 'Новая Заявка';
        $mail->Body = "На сайте была оставлена заявка через форму. \r\n Данные заявки: \r\n Имя: {$name} \r\n Емайл: {$email} \r\n Телефон: {$number} \r\n Описание: {$description} \r\n Было отправлено: {$datetime}";
        if (isset($images) && !empty($images)) {
            // return response()->json(['array' => $images], 500);
            $images = json_decode($images);
            foreach ($images as $image) {
                $temp = Image::where(['id' => $image])->get();
                foreach ($temp as $tmp) {
                    $mail->addAttachment(public_path($tmp->path));
                }
                // array_push($modelImages, $temp->path);
            }
        }
        $mail->SMTPDebug = true;
        $mail->Debugoutput = function ($str, $level) {
            // echo "$level: $str\n";
        };
        try {
            $mail->send();
            Cookie::queue(Cookie::forget('emailToken'));
            return response()->json(['status' => 'true']);
            // echo 'Email sent successfully!';
        } catch (Exception $e) {
            return response()->json(['status' => 'false']);
            // echo 'Email could not be sent. Error: ' . $mail->ErrorInfo;
        }
        exit;
    }
}
