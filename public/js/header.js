window.onload = function (){
    resize_header();
    Listener_scroll();
    init_button_color();

    qui_somme_nous();
    index();
}
window.addEventListener("resize",function (){
    resize_header();
})

function index(){
    let button = document.getElementById('button_close');
    button.addEventListener('click',function (){
        let main = document.getElementById('main')
        let modalSheet = document.getElementById('modalSheet');
        main.removeChild(modalSheet);
    })
}

function qui_somme_nous(){
    let qui_somme_nous = document.getElementById('qui_somme_nous');
    if (qui_somme_nous){
        qui_somme_nous.addEventListener('click', function() {
            window.scrollTo({
                top: 1500,
                behavior: 'smooth'
            });
        });
    }
}
function resize_header() {
    let group_button = document.getElementById("group_button");
    let group_form = document.getElementById("group_form");
    let group_button_2 = document.getElementById("group_button_2");
    if (window.innerWidth <= 991) {
        group_form.setAttribute("class", "d-flex flex-column gap-2")
        group_button.setAttribute("class", "d-flex flex-column gap-2")
        group_button_2.setAttribute("class", "d-flex flex-column gap-2")
    } else {
        group_button.setAttribute("class", "d-flex flex-row mx-2 gap-2")
        group_form.setAttribute("class", "d-flex flex-row gap-2")
        group_button_2.setAttribute("class", "d-flex flex-row gap-2")
    }
}

function init_button_color(){
    let div_button = document.getElementById("group_form");
    let button_search = div_button.getElementsByClassName("btn btn-outline-secondary");
    let button_inscription = div_button.getElementsByClassName("btn btn-outline-primary");
    button_search[0].classList.add("text-white");
    button_inscription[0].classList.add("text-white");

}

function Listener_scroll(){
    let header = document.getElementById("header-content");

    let all_nav_link = header.querySelectorAll("a");
    let div_button = document.getElementById("group_form");
    let button_search = div_button.getElementsByClassName("btn btn-outline-secondary");
    let button_inscription = div_button.getElementsByClassName("btn btn-outline-primary");
    if (window.location.pathname === "/"){
        window.addEventListener('scroll',function (){
            let scroll_height = document.documentElement.scrollTop;
            if (scroll_height === 0){
                header.classList.add("bg-transparent");
                header.classList.remove("bg-info-subtle");
                button_search[0].classList.add("text-white");
                button_search[0].classList.remove("text-success");
                button_inscription[0].classList.add("text-white");
                button_inscription[0].classList.remove("text-primary");
                for (let i = 0; i < all_nav_link.length; i++){
                    let class_name = all_nav_link[i].getAttribute('class');
                    if (class_name !== "dropdown-item text-dark"){
                        all_nav_link[i].classList.add("text-white");
                        all_nav_link[i].classList.remove("text-dark");
                    }
                }
            }else{
                console.log(window.location.pathname)
                header.classList.add("bg-info-subtle");
                button_search[0].classList.add("text-success");
                button_search[0].classList.remove("text-white");
                header.classList.remove("bg-transparent");
                button_inscription[0].classList.add("text-primary");
                button_inscription[0].classList.remove("text-white");
                for (let i = 0;i < all_nav_link.length; i++){
                    let class_name = all_nav_link[i].getAttribute('class');
                    if (class_name !== "dropdown-item text-dark"){
                        all_nav_link[i].classList.add("text-drak");
                        all_nav_link[i].classList.remove("text-white");
                    }
                }
            }

        })
    }else{
        header.classList.add("bg-info-subtle");
        button_search[0].classList.add("text-success");
        button_search[0].classList.remove("text-white");
        header.classList.remove("bg-transparent");
        button_inscription[0].classList.add("text-primary");
        button_inscription[0].classList.remove("text-white");
        for (let i = 0;i < all_nav_link.length; i++){
            let class_name = all_nav_link[i].getAttribute('class');
            if (class_name !== "dropdown-item text-dark"){
                all_nav_link[i].classList.add("text-drak");
                all_nav_link[i].classList.remove("text-white");
            }
        }
    }

}