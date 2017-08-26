import React from "react"

const Header = props => {
	;<header id="header">
		<div class="container">
			<div
				class="header_left_logo"
				style="float:left;margin: 0;padding: 0;height:100%;background-color: #183442"
			>
				<img src="images/icons/-delete.svg" class="corss-img" />
				<img src="images/icons/menu.svg" class="burger-img" />

				<a href="/" class="header_logo">
					<img src="src/images/mail_logo.png" class="header_logo-img" />
				</a>

				<div
					class="header_logo_text"
					style="cursor:pointer;float:left;font-weight: bold;color:white;"
					onclick="window.location='/'"
				>
					MAILBOX
				</div>
			</div>

			<div class="login_tag" style="border:1px solid #c1c1c1;">
				<a href="/" class="hader_menu-link">
					Sign up
				</a>
			</div>
			<div class="login_tag">
				<a href="/" class="hader_menu-link">
					Log in
				</a>
			</div>
			<div class="login_tag">
				<span class="dropdown">
					<i class="fa fa-smile-o fa-lg" onclick="" style="color:#eee;" />
				</span>
			</div>
		</div>
		<div class="lb_search_full" id="mobile_search">
			<input
				type="text"
				placeholder="Enter Inbox"
				class="lb-input"
				onkeydown="if (event.keyCode == 13) { subInboxSameZone($('#inbox_field_mob').val()); $('#inbox_field_mob').blur(); return false; }"
				id="inbox_field_mob"
			/>
			<span
				id="inbox_button_mob"
				class="lb-btn"
				onclick="subInboxSameZone($('#inbox_field_mob').val());  $('#inbox_field_mob').blur(); return false;"
			>
				<i class="fa fa-envelope fa-2x" style="color:white;padding-top: 8px;" />
			</span>
		</div>
		<div class="mail_header-all2" id="status_bar">
			<div style="float:right" style="margin:0;padding:0;">
				<span id="pane_status_msg" class="pane_status" style="color:blue;" />
				<span id="pane_error_msg" class="pane_status" style="color:red;" />
				<span
					class="fa-stack fa-manylarge"
					title="Delete Emails"
					onclick="trashEmails();"
					style="cursor: pointer"
				>
					<i
						class="fa fa-square fa-stack-2x"
						style="color:#aaa"
						id="trash_but"
					/>
					<i class="fa fa-trash fa-stack-1x fa-inverse" />
				</span>
				<span
					class="fa-stack fa-manylarge"
					title="Login to Save Emails"
					style="cursor: pointer"
				>
					<i
						class="fa fa-square fa-stack-2x"
						style="color: #aaa"
						id="save_but"
					/>
					<i class="fa fa-save fa-stack-1x fa-inverse" />
				</span>
				<span
					class="fa-stack fa-manylarge"
					title="Login to Forward Emails"
					style="cursor: pointer;"
				>
					<i
						class="fa fa-square fa-stack-2x"
						style="color: #aaa"
						id="forward_but"
					/>
					<i class="fa fa-mail-forward fa-stack-1x fa-inverse" />
				</span>
			</div>
		</div>
	</header>
}

export default Header
