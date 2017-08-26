import React, { Component } from "react"
import ReactDOM from "react-dom"

import { app, db } from "./utils/index.js"
import { writeUserData } from "./utils/db.js"

import "./style/index.css"

console.log(app)
writeUserData()

ReactDOM.render(<h1>Hello World!</h1>, document.getElementById("root"))
