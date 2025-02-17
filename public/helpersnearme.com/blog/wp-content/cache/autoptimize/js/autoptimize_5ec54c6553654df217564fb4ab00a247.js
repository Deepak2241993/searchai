(function(){"use strict";const select=(el,all=false)=>{el=el.trim()
if(all){return[...document.querySelectorAll(el)]}else{return document.querySelector(el)}}
const on=(type,el,listener,all=false)=>{let selectEl=select(el,all)
if(selectEl){if(all){selectEl.forEach(e=>e.addEventListener(type,listener))}else{selectEl.addEventListener(type,listener)}}}
const onscroll=(el,listener)=>{el.addEventListener('scroll',listener)}
let selectHeader=select('#header')
if(selectHeader){const headerScrolled=()=>{if(window.scrollY>100){selectHeader.classList.add('header-scrolled')}else{selectHeader.classList.remove('header-scrolled')}}
window.addEventListener('load',headerScrolled)
onscroll(document,headerScrolled)}
let preloader=select('#preloader');if(preloader){window.addEventListener('load',()=>{preloader.remove()});}
let backtotop=select('.back-to-top')
if(backtotop){const toggleBacktotop=()=>{if(window.scrollY>100){backtotop.classList.add('active')}else{backtotop.classList.remove('active')}}
window.addEventListener('load',toggleBacktotop)
onscroll(document,toggleBacktotop)}
on('click','#navbar',function(e){this.classList.toggle('navbar-mobile')
select('.mobile-nav-toggle').classList.toggle('bi-list');select('.mobile-nav-toggle').classList.toggle('bi-x');[].forEach.call(select('.dropdown-active',true),function(el){el.classList.remove("dropdown-active");});})
on('click','.navbar .dropdown > a',function(e){if(select('#navbar').classList.contains('navbar-mobile')){e.preventDefault()
e.stopPropagation()
this.nextElementSibling.classList.toggle('dropdown-active')}},true)})();