import {
  addNote,
  deleteNote,
  getAllNotes,
} from "../controller/notesController";
import express from "express";

export default (router: express.Router) => {
  router.get("/notes", getAllNotes);
  router.post("/notes", addNote);
  router.delete("/notes/:id", deleteNote);
};
