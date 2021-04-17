import { createApp } from "vue";
import App from "./App.vue";
import router from "./router/index";
import store from "./store/index";

// Assets
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

// Ui Components
import container from "./components/ContainerFrontPages.vue";
import TheHeader from "./components/TheHeader.vue";

const app = createApp(App);

app.component("container", container);
app.component("TheHeader", TheHeader);

app.use(router);

app.use(store);

app.mount("#app");
