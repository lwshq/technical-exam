<template>
  <v-app>
    <v-app-bar :elevation="2" color="primary">
      <v-app-bar-title
        >Light Weight Solutions ( Notes and Activity Tracker)</v-app-bar-title
      >
    </v-app-bar>
    <v-main>
      <div>
        <v-container fluid>
          <v-row dense>
            <v-col lg="3" md="4" sm="12"><todo-list></todo-list></v-col>
            <v-col lg="9" md="8" sm="12"><notes></notes></v-col>
          </v-row>
        </v-container>
      </div>
    </v-main>
  </v-app>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import Notes from "./components/Notes.vue";
import TodoList from "./components/TodoList.vue";

export default defineComponent({
  name: "App",
  components: { Notes, TodoList },
  data() {
    return {
      //
    };
  },
});
</script>
