import "./es5-shims.min";
import "./share";

export function yandex_shared(id, path) {
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
        content: {
            // image: path,
            url: 'https://yandex.com',
            title: 'Yandex',
            description: 'All about Yandex',
            image: 'https://yastatic.net/morda-logo/i/logo.svg'   
        },
        theme : {
            services: 'vkontakte,telegram,whatsapp,pinterest',
            lang: 'ru',
            limit: 0,
            size: 's',
            bare: false,
            popupPosition: 'outer',
            moreButtonType: "short",
            colorScheme: 'whiteblack',
            // popupDirection: ''
        },
        
    // });
});
}
