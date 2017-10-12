import React, { Component } from "react"
import ReactDOM from "react-dom"

import { app, db } from "./utils/index.js"
import { setMail } from "./utils/db.js"

import AnonymousMail from "./components/AnonymousMail.js"

import "./style/index.css"

console.log(app)
setMail()

ReactDOM.render(<AnonymousMail />, document.getElementById("root"))
