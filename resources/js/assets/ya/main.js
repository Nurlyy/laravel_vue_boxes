import "./es5-shims.min";
import "./share";

export function yandex_shared(id) {
    new Ya.share2(id, {
        content: {},
        theme: {
            services: 'vkontakte,facebook,odnoklassniki,moimir,twitter,lj,collections,viber,whatsapp,skype,telegram',
            lang: 'ru',
            limit: 5,
            size: 'm',
            bare: false,
            popupDirection: 'bottom'
        }});
    // });
}
