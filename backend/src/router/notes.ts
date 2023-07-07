import {
  addNote,
  deleteNote,
  getAllNotes,
  updateNote,
} from "../controller/notesController";
import express from "express";

export default (router: express.Router) => {
  router.get("/notes", getAllNotes);
  router.post("/notes", addNote);
  router.delete("/notes/:id", deleteNote);
  router.put("/notes/:id", updateNote);
};
