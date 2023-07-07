import {
  addTodo,
  deleteMany,
  deleteTodo,
  getAllTodos,
  updateTodoById,
} from "../controller/todoController";
import express from "express";

export default (router: express.Router) => {
  router.get("/todos", getAllTodos);
  router.post("/todos", addTodo);
  router.delete("/todosDelete", deleteMany);
  router.delete("/todos/:id", deleteTodo);
  router.put("/todos/:id", updateTodoById);
};
