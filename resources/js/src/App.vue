<script>
import { reactive } from "vue";
import store from "./store";

export function useCounter() {
    const state = reactive({
        count: store.state.count,
    });

    function increment() {
        state.count++;
    }

    return {
        state,
        increment,
    };
}
export default {
    setup() {
        const { state, increment } = useCounter();

        return {
            state,
            increment,
        };
    },
};
</script>
<!-- ExampleComponent.vue -->
<template>
    <div>
        <p>{{ state.count }}</p>
        <button @click="increment">Increment</button>
    </div>
</template>
