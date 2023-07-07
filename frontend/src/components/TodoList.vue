<template>
  <v-card class="todo-section">
    <h3 class="text-center mb-4">Todo List</h3>

    <v-divider :thickness="2"></v-divider>

    <div class="mt-4 mb-4 d-flex flex-column">
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

    <div class="mb-4">
      <template v-for="(entry, i) in todoList" :key="i">
        <v-sheet
          class="entries-class d-flex justify-space-between"
          :elevation="3"
          rounded
        >
          <div @click="updateTodo(entry.done, i)" class="ch-container">
            <v-checkbox :model-value="entry.done" class="checkboxes-class">
              <template v-slot:label>
                <p class="label-style" :class="checkIfDone(entry.done)">
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
            @click="removeTodo(i)"
            >X</v-btn
          >
        </v-sheet>
      </template>
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

interface TodoEntryType {
  title: string;
  done: boolean;
}

export default defineComponent({
  name: "TodoList",

  components: {},

  data() {
    return {
      todoEntry: "",
      todoList: [] as TodoEntryType[],
    };
  },

  methods: {
    addEntry() {
      if (!this.todoEntry.trim()) return;

      const entry: TodoEntryType = {
        title: this.todoEntry,
        done: false,
      };

      this.todoList.push(entry);
      this.todoEntry = "";
    },

    checkIfDone(done: boolean) {
      return done ? "done" : "";
    },

    updateTodo(entryDone: boolean, i: number) {
      console.log(entryDone);
      this.todoList[i].done = !entryDone;
    },

    removeTodo(i: number) {
      this.todoList.splice(i, 1);
    },

    removeDone() {
      this.todoList = this.todoList.filter(({ done }) => !done);
    },
  },
});
</script>

<style>
.todo-section {
  padding: 10px;
  height: 85vh;
  max-height: 85vh;
  overflow: auto;
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
</style>
