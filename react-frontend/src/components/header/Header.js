import React, { Component } from "react"

class Header extends Component {
	constructor(props) {
		super(props)
	}

	render() {
		return (
			<header id="header">
				<div className="container">
					<div className="header_left_logo">
						<img src="images/icons/-delete.svg" className="corss-img" />
						<img src="images/icons/menu.svg" className="burger-img" />

						<a href="/" className="header_logo">
							<img src="src/images/mail_logo.png" className="header_logo-img" />
						</a>

						<div className="header_logo_text">MAILBOX</div>
					</div>

					<div className="login_tag" style={{ border: "1px solid #c1c1c1" }}>
						<a href="/" className="hader_menu-link">
							Sign up
						</a>
					</div>
					<div className="login_tag">
						<a href="/" className="hader_menu-link">
							Log in
						</a>
					</div>
					<div className="login_tag">
						<span className="dropdown">
							<i className="fa fa-smile-o fa-lg" style={{ color: "#eee" }} />
						</span>
					</div>
				</div>
				<div className="lb_search_full" id="mobile_search">
					<input
						type="text"
						placeholder="Enter Inbox"
						className="lb-input"
						id="inbox_field_mob"
					/>
					<span id="inbox_button_mob" className="lb-btn">
						<i
							className="fa fa-envelope fa-2x"
							style={{ color: "white", paddingTop: "8px" }}
						/>
					</span>
				</div>
				<div className="mail_header-all2" id="status_bar">
					<div style={{ float: "right", margin: 0, padding: 0 }}>
						<span
							id="pane_status_msg"
							className="pane_status"
							style={{ color: "blue" }}
						/>
						<span
							id="pane_error_msg"
							className="pane_status"
							style={{ color: "red" }}
						/>
						<span
							className="fa-stack fa-manylarge"
							title="Delete Emails"
							style={{ cursor: "pointer" }}
						>
							<i
								className="fa fa-square fa-stack-2x"
								style={{ color: "#aaa" }}
								id="trash_but"
							/>
							<i className="fa fa-trash fa-stack-1x fa-inverse" />
						</span>
						<span
							className="fa-stack fa-manylarge"
							title="Login to Save Emails"
							style={{ cursor: "pointer" }}
						>
							<i
								className="fa fa-square fa-stack-2x"
								style={{ color: "#aaa" }}
								id="save_but"
							/>
							<i className="fa fa-save fa-stack-1x fa-inverse" />
						</span>
						<span
							className="fa-stack fa-manylarge"
							title="Login to Forward Emails"
							style={{ cursor: "pointer" }}
						>
							<i
								className="fa fa-square fa-stack-2x"
								style={{ color: "#aaa" }}
								id="forward_but"
							/>
							<i className="fa fa-mail-forward fa-stack-1x fa-inverse" />
						</span>
					</div>
				</div>
			</header>
		)
	}
}

export default Header
