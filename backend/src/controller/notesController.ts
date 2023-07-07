import { createNote, deleteNoteById, getNotes } from "../db/notes";
import express from "express";

export const getAllNotes = async (
  req: express.Request,
  res: express.Response
) => {
  try {
    const notes = await getNotes();

    return res.status(200).json(notes);
  } catch (error) {
    console.log(error);
    res.sendStatus(400);
  }
};

export const addNote = async (req: express.Request, res: express.Response) => {
  try {
    console.log(req.body);
    const note = await createNote(req.body);
    console.log(note);
    return res.status(200).json(note);
  } catch (error) {
    console.log(error);
    res.sendStatus(400);
  }
};

export const deleteNote = async (
  req: express.Request,
  res: express.Response
) => {
  try {
    const id = req.params.id;
    await deleteNoteById(id);

    return res.sendStatus(200);
  } catch (error) {
    console.log(error);
    return res.sendStatus(400);
  }
};
