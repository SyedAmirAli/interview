import { createApp } from "vue";
import store from "./src/store";
import App from "./src/App.vue";

const app = createApp(App);
app.use(store);
app.mount("#app");
