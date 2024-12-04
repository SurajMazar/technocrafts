/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.config.devtools = false;
// import html2canvas from 'html2canvas';
// import pdfMake from 'pdfmake';
//   window.pdfMake=pdfMake;
//   window.html2canvas=html2canvas;
// v-form
import { Form, HasError, AlertError } from 'vform';
window.Form=Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
// end v-form

import Swal from 'sweetalert2';
window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
 window.Toast=Toast;


Vue.filter('Trim_title', function(string,num){
  // let array = string.trim().split(' ');
  // let end = string.length > 5 ? '...' : '';
  // return array.slice(0,5).join(' ') + end;
  if(string.length > num){ string = string.substring(0,num)+'...'};
  return string;
});

Vue.filter('dollar', function(string){
    let hundred = string.toString().slice(-3)
    let remaining = string.toString().slice(0,-3)

    remaining = remaining.toString().replace(/\B(?=(\d{2})+(?!\d))/g, ",")
    return 'Rs '+ remaining + ','+ hundred
 })

Vue.filter('emi', function(string){
    let decimal = string.toString().slice(-3)
    let main = string.toString().slice(0,-3)
    let hundred = main.toString().slice(-3)
    let remaining = main.toString().slice(0,-3)

    remaining = remaining.toString().replace(/\B(?=(\d{2})+(?!\d))/g, ",")
    if (remaining){
    return 'Rs '+ remaining + ','+ hundred+decimal
  }else{
    return 'Rs '+ hundred+decimal
  }
 })

import moment from 'moment';
 Vue.filter('myDate',function(date){
  return moment(date).format('MMM DD YYYY');
 });

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('pagination',require('laravel-vue-pagination'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */





// front end components

Vue.component('loader-front', require('./components/frontend/loader-front.vue').default);

Vue.component('emi', require('./components/frontend/UI/EMI.vue').default);

Vue.component('price', require('./components/frontend/UI/price.vue').default);

Vue.component('subscriber', require('./components/frontend/UI/subscriber.vue').default);

Vue.component('latest-blogs', require('./components/frontend/home/LatestBlogs.vue').default);

Vue.component('recommendated-blogs', require('./components/frontend/home/recommeded-blogs.vue').default);

Vue.component('featured-blogs', require('./components/frontend/home/FeaturedBlogs.vue').default);

Vue.component('most-viewed-list', require('./components/frontend/home/most-viewed.vue').default);

Vue.component('blogs-list', require('./components/frontend/blogs/blogs.vue').default);

Vue.component('blogs-listing', require('./components/frontend/blogs/blog-listing.vue').default);

Vue.component('blog-sidebar', require('./components/frontend/blogs/BlogSideBar.vue').default);

Vue.component('ads-single-row', require('./components/frontend/Advertisement/AdvertisementSingleRow').default);

Vue.component('ads-long', require('./components/frontend/Advertisement/AdvertisementLong').default);


Vue.component('ads-3-col', require('./components/frontend/Advertisement/Ads3Column').default);

Vue.component('ads-2-col', require('./components/frontend/Advertisement/Ads2Column').default);

Vue.component('ads-1-col', require('./components/frontend/Advertisement/Ads1Column').default);

Vue.component('ads-full-page', require('./components/frontend/Advertisement/AdsFullpage').default);


// front end component

// laptop listing
Vue.component('laptop-listing', require('./components/frontend/laptop/Laptop.vue').default);

Vue.component('laptop-detail', require('./components/frontend/laptop/LaptopDetails.vue').default);

Vue.component('laptop-sidebar', require('./components/frontend/laptop/laptopSideBar.vue').default);
// end laptop listing


// brand listing

// end brand listing
 Vue.component('brand-listing',require('./components/frontend/brands/brandListing.vue').default);



// SVGAElement
 Vue.component('first-image',require('./components/frontend/SVG/first-image.vue').default);

 Vue.component('writing-image',require('./components/frontend/SVG/writing.vue').default);

 Vue.component('attachment-image',require('./components/frontend/SVG/attachment-image.vue').default);

 Vue.component('review-image',require('./components/frontend/SVG/review-image.vue').default);

 Vue.component('submission-from',require('./components/frontend/become-a-writer/form.vue').default);

// end svg



 // administration

 // compage gadget
 Vue.component('compare-gadget',require('./components/frontend/compare-gadget/CompareGadget.vue').default);
 // compare gadget



 //smartphone

 Vue.component('smartphone-list',require('./components/frontend/smartphone/smartphone-listing.vue').default);
 Vue.component('smartphone-sidebar',require('./components/frontend/smartphone/smartphone-sidebar.vue').default);

 //smartphone

 // loader
 Vue.component('loader', require('./components/admin/loader.vue').default);

 Vue.component('product-detail-slider', require('./components/frontend/slider/Product-detail-slider.vue').default);
// Backend



 // blogs
 Vue.component('adminblogcategory', require('./components/admin/blogs/Blogcategory.vue').default);

 Vue.component('adminblog', require('./components/admin/blogs/Blog.vue').default);

 Vue.component('admincreateblog', require('./components/admin/blogs/CreateBlog.vue').default);

 Vue.component('admineditblog', require('./components/admin/blogs/EditBlog.vue').default);

 Vue.component('admintrashblog', require('./components/admin/blogs/TrashBlogs.vue').default);
 // end blogs



 //brands
 Vue.component('adminbrand', require('./components/admin/brand/Brand.vue').default);

 Vue.component('adminbrandtrash', require('./components/admin/brand/Trash.vue').default);
 // end brand component



 // laptops
 Vue.component('adminlaptop', require('./components/admin/laptop/laptop.vue').default);

 Vue.component('adminaddlaptop', require('./components/admin/laptop/addlaptop.vue').default);

 Vue.component('admineditlaptop', require('./components/admin/laptop/editlaptop.vue').default);

 Vue.component('adminlaptoptrash', require('./components/admin/laptop/Trash.vue').default);
 // end laptop component

 // advertisement component


 // advertisement category component
 Vue.component('admin-adsmanager',require('./components/admin/advertisement/Ads.vue').default)

 Vue.component('admin-ads-category',require('./components/admin/advertisement/AdsCategory.vue').default);

 Vue.component('admin-ads-category-trash',require('./components/admin/advertisement/AdsCatTrash.vue').default);

 // end ads category component

// noticeboard Component
 Vue.component('noticeboard',require('./components/admin/Noticeboard/Noticeboard.vue').default);


 // end advertisement component


 // admin smartphone

 Vue.component('admin-smartphone',require('./components/admin/Smartphone/Smartphone.vue').default);

 Vue.component('admin-add-smartphone',require('./components/admin/Smartphone/addSmartphone.vue').default);

 Vue.component('admin-edit-smartphone',require('./components/admin/Smartphone/edit.vue').default);

 Vue.component('smartphone-brands',require('./components/admin/SmartphoneBrands/Brands.vue').default);


// become a writer
 Vue.component('admin-writings',require('./components/admin/become-a-writer/index.vue').default);

// admin user component

 Vue.component('user',require('./components/admin/user/index.vue').default);

 Vue.component('user-create',require('./components/admin/user/user-create.vue').default);

 Vue.component('user-profile',require('./components/admin/user/profile.vue').default);

 Vue.component('dashboard-laptop',require('./components/admin/ui/dashboard-listing-laptop.vue').default);

 Vue.component('dashboard-smartphone',require('./components/admin/ui/dashboard-listing-smartphone.vue').default);

// subscriber component
 Vue.component('admin-subscriber',require('./components/admin/subscriber/index.vue').default);

// end Backend components

const app = new Vue({
    el: '#app',
});
