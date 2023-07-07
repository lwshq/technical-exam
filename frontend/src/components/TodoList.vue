<template>
  <v-card class="todo-section">
    <v-overlay
      v-model="loading"
      contained
      class="align-center justify-center"
      :persistent="true"
      ><v-progress-circular
        color="primary"
        indeterminate
        size="64"
      ></v-progress-circular
    ></v-overlay>

    <h3 class="text-center mb-4 section-title">Todo List</h3>

    <v-divider :thickness="2"></v-divider>

    <div class="mt-4 mb-3 d-flex flex-column">
      <v-text-field
        v-model="todoEntry"
        label="Todo Entry"
        class="text-field-class"
      ></v-text-field>
      <v-btn
        text="Add Entry"
        @click="addEntry"
        color="primary"
        v-on:keyup.enter="addEntry"
      ></v-btn>
    </div>

    <v-divider :thickness="2"></v-divider>

    <div class="mb-4 todo-list-container">
      <v-sheet
        v-for="(entry, i) in todoList"
        :key="i"
        class="entries-class d-flex justify-space-between"
        :elevation="3"
        rounded
      >
        <div @click="updateTodo(entry)" class="ch-container">
          <v-checkbox :model-value="entry.done" class="checkboxes-class">
            <template v-slot:label>
              <p
                class="label-style d-inline-block text-truncate"
                :class="checkIfDone(entry.done)"
              >
                {{ entry.title }}
              </p>
            </template>
          </v-checkbox>
        </div>
        <v-btn
          density="compact"
          icon="mdi-plus"
          color="red"
          class="mr-2"
          @click="removeTodo(entry)"
          ><v-icon>mdi-trash-can</v-icon></v-btn
        >
      </v-sheet>
    </div>

    <v-divider :thickness="2"></v-divider>

    <div class="mt-5 d-flex justify-center">
      <v-btn variant="outlined" @click="removeDone" color="primary">
        Remove Done
      </v-btn>
    </div>
  </v-card>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { TodoEntryType } from "../interface/interfaces";
import axios from "axios";

const api = "http://localhost:8080"; // For localhost server

export default defineComponent({
  name: "TodoList",

  components: {},

  data() {
    return {
      loading: true,
      todoEntry: "",
      todoList: [] as TodoEntryType[],
    };
  },

  methods: {
    addEntry() {
      if (!this.todoEntry.trim()) return;

      this.loading = true;

      const entry: TodoEntryType = {
        title: this.todoEntry,
        done: false,
      };

      this.todoList.push(entry);
      axios
        .post(`${api}/todos`, entry)
        .then(() => {
          // handle success
          this.fetchTodos();
          this.todoEntry = "";
        })
        .catch((error: Error) => console.log(error));
    },

    checkIfDone(done: boolean) {
      return done ? "done" : "";
    },

    updateTodo(entry: TodoEntryType) {
      this.loading = true;
      axios
        .put(`${api}/todos/${entry._id}`, { ...entry, done: !entry.done })
        .then(() => {
          this.fetchTodos();
        })
        .catch((error: Error) => console.log(error));
    },

    removeTodo(val: TodoEntryType) {
      this.loading = true;
      axios
        .delete(`${api}/todos/${val._id}`)
        .then(() => {
          this.fetchTodos();
        })
        .catch((error: Error) => console.log(error));
    },

    removeDone() {
      this.loading = true;
      axios
        .delete(`${api}/todosDelete`)
        .then(() => {
          this.fetchTodos();
        })
        .catch((error: Error) => console.log(error));
    },
    fetchTodos() {
      axios
        .get(`${api}/todos`)
        .then((response: any) => {
          // handle success
          this.todoList = response.data;
          this.loading = false;
        })
        .catch((error: Error) => console.log(error));
    },
  },
  created() {
    this.fetchTodos();
  },
});
</script>

<style>
.todo-section {
  padding: 10px;
  height: 90vh;
  max-width: 500px;
  min-width: 400px;
  margin: auto;
  max-height: 85vh;
}
.text-field-class {
  margin-bottom: 0;
}

.v-label--clickable {
  color: blacks;
}

.done {
  text-decoration: line-through;
}

.entries-class {
  height: 50px;
  color: white;
  margin-bottom: 4px;
  display: flex;
  align-items: center;
  cursor: pointer;
}

.checkboxes-class {
  display: flex;
  align-items: center;
  width: 100%;
}

.ch-container {
  width: 100%;
}

.v-label--clickable {
  pointer-events: none;
}

.todo-list-container {
  height: 50vh;
  max-height: 50vh;
  overflow-y: auto;
  margin: 20px 0 20px 0;
}

.section-title {
  background-color: #e3f2fd;
  padding: 10px 0 10px 0;
}
</style>
