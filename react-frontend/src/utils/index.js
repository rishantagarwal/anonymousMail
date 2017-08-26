import * as firebase from "firebase"
import { fireBaseConfig } from "./../config.js"

export const app = firebase.initializeApp(fireBaseConfig)
export const db = firebase.database()
