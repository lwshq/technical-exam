import mongoose, { mongo } from "mongoose";

interface TodoDto {
  title: string;
  done: boolean;
}

const TodosSchema = new mongoose.Schema({
  title: {
    type: String,
    required: true,
  },
  done: {
    type: Boolean,
    required: true,
  },
});

export const TodoModel = mongoose.model("Todo", TodosSchema);

export const getTodos = () => TodoModel.find();
export const getTodosById = (id: string) => TodoModel.findOne({ _id: id });
export const createTodo = (val: TodoDto) =>
  new TodoModel(val).save().then((todo) => todo.toObject());
export const updateTodo = (id: string, val: TodoDto) =>
  TodoModel.findByIdAndUpdate(id, val);
export const deleteTodoById = (id: string) =>
  TodoModel.findOneAndDelete({ _id: id });
export const deleteAllDone = () => TodoModel.deleteMany({ done: true });
