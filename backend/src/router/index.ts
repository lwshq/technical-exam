import express from "express";
import notes from "./notes";
import todos from "./todos";

const router = express.Router();

export default (): express.Router => {
  notes(router);
  todos(router);

  return router;
};
