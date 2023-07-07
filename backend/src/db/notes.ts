import mongoose, { mongo } from "mongoose";

interface NoteDto {
  title: string;
  description: string;
}

const NotesSchema = new mongoose.Schema({
  title: {
    type: String,
    required: true,
  },
  description: {
    type: String,
  },
});

export const NoteModel = mongoose.model("Note", NotesSchema);

export const getNotes = () => NoteModel.find();
export const getNotesById = (id: string) => NoteModel.findOne({ _id: id });
export const createNote = (val: NoteDto) =>
  new NoteModel(val).save().then((note) => note.toObject());
export const updateNote = (id: string, val: NoteDto) =>
  NoteModel.findByIdAndUpdate(id, val);
export const deleteNoteById = (id: string) =>
  NoteModel.findOneAndDelete({ _id: id });
