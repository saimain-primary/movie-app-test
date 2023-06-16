import "../css/app.css";
import { createApp } from "vue";
import router from "./router";
import App from "./components/App.vue";

const app = createApp({
    components: {
        App,
    },
});

app.use(router);
app.mount("#app");
