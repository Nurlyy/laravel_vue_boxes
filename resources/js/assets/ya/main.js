import "./es5-shims.min";
import "./share";

export function yandex_shared(id) {
    new Ya.share2(id, {
        // theme: {
        //     services: 'vkontakte,facebook,odnoklassniki,moimir,twitter,lj,collections,viber,whatsapp,skype,telegram',
        //     lang: 'ru',
        //     limit: 0,
        //     size: 'm',
        //     bare: false,
        //     popupDirection: 'bottom',
        //     moreButtonType: 'short',
        // }});
        theme: {
            services: 'messenger,lj,viber,twitter',
            lang: 'uk',
            limit: 0,
            size: 's',
            bare: false,
            popupPosition: 'outer',
            // popupDirection: ''
        }});
    // });
}
