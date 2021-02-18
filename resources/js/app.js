require('./bootstrap');
window.Vue = require('vue').default;

import App from "./components/App";
import Items from "./components/Items";
import Validation from "./components/Validation";

Vue.component('items', Items);
Vue.component('validation-errors', Validation);

const app = new Vue({
    el: '#app',
    render: h => h(App)
});
