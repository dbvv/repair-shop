window._ = require('lodash');
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */
try {
  window.Popper = require('popper.js').default;
  window.$ = window.jQuery = require('jquery');
  require('jquery-ui/ui/widgets/autocomplete.js');
  require('bootstrap');
  require('tinymce/tinymce');
  require('tinymce/themes/silver/theme');
  require('tinymce/plugins/paste/plugin');
  require('tinymce/plugins/advlist/plugin');
  require('tinymce/plugins/autolink/plugin');
  require('tinymce/plugins/anchor/plugin');
  require('tinymce/plugins/autoresize/plugin');
  require('tinymce/plugins/autosave/plugin');
  require('tinymce/plugins/charmap/plugin');
  require('tinymce/plugins/code/plugin');
  require('tinymce/plugins/colorpicker/plugin');
  require('tinymce/plugins/contextmenu/plugin');
  require('tinymce/plugins/directionality/plugin');
  require('tinymce/plugins/emoticons/plugin');
  require('tinymce/plugins/fullpage/plugin');
  require('tinymce/plugins/lists/plugin');
  require('tinymce/plugins/link/plugin');
  require('tinymce/plugins/fullscreen/plugin');
  require('tinymce/plugins/help/plugin');
  require('tinymce/plugins/hr/plugin');
  require('tinymce/plugins/image/plugin');
  require('tinymce/plugins/imagetools/plugin');
  require('tinymce/plugins/insertdatetime/plugin');
  require('tinymce/plugins/media/plugin');
  require('tinymce/plugins/pagebreak/plugin');
  require('tinymce/plugins/preview/plugin');
  require('tinymce/plugins/print/plugin');
  require('tinymce/plugins/save/plugin');
  require('tinymce/plugins/searchreplace/plugin');
  require('tinymce/plugins/table/plugin');
  require('tinymce/plugins/textcolor/plugin');
  require('tinymce/plugins/textpattern/plugin');
  require('tinymce/plugins/template/plugin');
  require('tinymce/plugins/visualchars/plugin');
  require('tinymce/plugins/visualblocks/plugin');
  require('tinymce/plugins/wordcount/plugin');
  require('tinymce-i18n/langs/ru');
  require('bootstrap-notify/bootstrap-notify');
} catch (e) {}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo'
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });