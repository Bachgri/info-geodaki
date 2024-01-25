window.updateMenu;

document.addEventListener('DOMContentLoaded', () => {
    const orgMenu = document.querySelector('#menu').cloneNode(true);
    let newMenu = false;
    let updated = false;
    
    window.updateMenu = (opts, conf) => {

        // document.documentElement.classList.remove('class');
        document.body.removeAttribute('class');

        document.querySelector('#menu')?.remove();
        
        newMenu = orgMenu.cloneNode(true);
        document.body.prepend(newMenu);

        const api = new Mmenu(
            newMenu,
            JSON.parse(JSON.stringify(opts)), 
            JSON.parse(JSON.stringify(conf))
        );

        if (updated) {
            api?.open?.();
        }
        updated = true;
    };
});
