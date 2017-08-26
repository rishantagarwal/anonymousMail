import { db } from "./index.js"
import hash from "string-hash"

export function setMail(
	userId = 0,
	name = "null",
	email = "bindasrishant@gmail.com",
	imageUrl = "http://www.google.com"
) {
	db.ref("/" + hash(email)).set({
		username: name,
		userId: userId,
		email: email,
		profile_picture: imageUrl
	})
}

export function getAllMails(email = "bindasrishant@gmail.com") {}
