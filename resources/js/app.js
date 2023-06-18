import "../css/app.css";
import { createApp } from "vue";
import router from "./router";
import App from "./components/App.vue";
import { createPinia } from 'pinia'

const pinia = createPinia()
const app = createApp({
    components: {
        App,
    },
});

app.use(router);
app.use(pinia);
app.mount("#app");
