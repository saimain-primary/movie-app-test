import "../css/app.css";
import { createApp } from "vue";
import router from "./router";
import App from "./components/App.vue";
import { createPinia } from 'pinia'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

const pinia = createPinia()
const app = createApp({
    components: {
        App,
    },
});

app.use(router);
app.component('v-select', vSelect);
app.use(pinia);
app.mount("#app");
