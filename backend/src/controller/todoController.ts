import {
  createTodo,
  deleteAllDone,
  deleteTodoById,
  getTodos,
  updateTodo,
} from "../db/todo";
import express from "express";

export const getAllTodos = async (
  req: express.Request,
  res: express.Response
) => {
  try {
    const Todos = await getTodos();

    return res.status(200).json(Todos);
  } catch (error) {
    console.log(error);
    res.sendStatus(400);
  }
};

export const addTodo = async (req: express.Request, res: express.Response) => {
  try {
    console.log(req.body);
    const Todo = await createTodo(req.body);
    console.log(Todo);
    return res.status(200).json(Todo);
  } catch (error) {
    console.log(error);
    res.sendStatus(400);
  }
};

export const deleteTodo = async (
  req: express.Request,
  res: express.Response
) => {
  try {
    const id = req.params.id;
    await deleteTodoById(id);

    return res.sendStatus(200);
  } catch (error) {
    console.log(error);
    return res.sendStatus(400);
  }
};

export const updateTodoById = async (
  req: express.Request,
  res: express.Response
) => {
  try {
    const id = req.params.id;
    await updateTodo(id, req.body);

    return res.sendStatus(200);
  } catch (error) {
    console.log(error);
    return res.sendStatus(400);
  }
};

export const deleteMany = async (
  req: express.Request,
  res: express.Response
) => {
  try {
    await deleteAllDone();

    return res.sendStatus(200);
  } catch (error) {
    console.log(error);
    return res.sendStatus(400);
  }
};
