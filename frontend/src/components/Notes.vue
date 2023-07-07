<template>
  <v-card class="note-container">
    <div class="d-flex header mb-4">
      <h3 class="text-center mr-2">Notes</h3>
      <v-btn density="compact" icon="mdi-plus" color="primary">
        +
        <v-dialog
          v-model="dialog"
          activator="parent"
          width="400px"
          class="dialog-create"
        >
          <v-card>
            <v-container fluid>
              <v-text-field
                v-model="note.title"
                label="Title"
                :rules="titleRules"
              ></v-text-field>

              <v-textarea v-model="note.description" label="Label"></v-textarea>

              <div class="d-flex justify-center">
                <v-btn class="mt-2" @click="addNote" color="primary"
                  >Add Note</v-btn
                >
                <v-btn class="mt-2" @click="dialog = false" color="red"
                  >Cancel</v-btn
                >
              </div>
            </v-container>
          </v-card>
        </v-dialog>
      </v-btn>
    </div>

    <v-divider :thickness="2"></v-divider>

    <div class="d-flex flex-wrap justify-center">
      <template v-if="noteList.length > 0">
        <v-card v-for="(note, i) in noteList" :key="i" class="note-cards">
          <v-card-item>
            <div class="d-flex justify-space-between">
              <v-card-title>{{ note.title }}</v-card-title>
              <v-btn density="compact" icon="mdi-plus" @click="deleteNote(note)"
                >x</v-btn
              >
            </div>
          </v-card-item>

          <v-card-text> {{ note.description }} </v-card-text>
        </v-card>
      </template>
      <template v-else>
        <div
          class="d-flex flex-column justify-center align-center empty-wrapper"
        >
          <h3>You Dont Have Notes. Add A Note By Clicking the button below</h3>
          <v-btn variant="text" @click="dialog = true"> Add Note + </v-btn>
        </div>
      </template>
    </div>
  </v-card>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { NotesDto } from "../interface/interfaces";
import axios from "axios";

const api = "http://localhost:8080"; // For localhost server

export default defineComponent({
  name: "Notes",

  components: {},

  data() {
    return {
      dialog: false,
      note: {} as NotesDto,
      noteList: [] as NotesDto[],
      titleRules: [
        (value: string) => {
          if (value?.length > 0) return true;

          return "Title is Required";
        },
      ],
    };
  },

  methods: {
    addNote() {
      if (!this.note.title) return;

      axios
        .post(`${api}/notes`, this.note)
        .then(() => {
          // handle success
          this.fetchNotes();
          this.note = {} as NotesDto;
          this.dialog = false;
        })
        .catch((error: Error) => console.log(error));
    },
    deleteNote(val: NotesDto) {
      axios
        .delete(`${api}/notes/${val._id}`)
        .then(() => {
          this.fetchNotes();
        })
        .catch((error: Error) => console.log(error));
    },
    fetchNotes() {
      axios
        .get(`${api}/notes`)
        .then((response: any) => {
          // handle success
          this.noteList = response.data;
        })
        .catch((error: Error) => console.log(error));
    },
  },
  created() {
    this.fetchNotes();
  },
});
</script>

<style scoped>
.note-container {
  height: 85vh;
  max-height: 85vh;
  overflow: auto;
  padding: 10px;
}

.dialog-create {
  padding: 20px;
}

.empty-wrapper {
  text-align: center;
  margin-top: 5rem;
}

.note-cards {
  margin: 10px;
  height: fit-content;
  width: 300px;
}
</style>
