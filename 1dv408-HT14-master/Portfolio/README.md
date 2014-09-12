PHP-Portfolio
=============

Lecture example code for 1DV408.


Roles:
------
Visitor, any user that wishes to view portfolios, projects and items
Project Participant, is related to a project, created a project or invited into a project
Portfolio Owner, A participant that has created or was invited into a project
Item Owner, A participant that has created an object

Terms:
------
Project, A description of a project. title, creation date, and description, may have several "items".
Project Item, An item related to a project, could be an image, url or a text. Owned by a Participant.
Portfolio, A collection of projects related to a Portfolio Owner.

http://yuml.me/edit/9d8f3a84

Use-cases:
======================================

A Visitor Views a Portfolio of Projects
---------------------------------------
A visitor wishes to view a portfolio related to a Portfolio Owner.
1. System shows available portfolio owners.
2. The visitor selects a portfolio owner.
3. The system shows a portfolio of all projects where the owner is participant.


Portfolio Owner creates a new Project
-------------------------------------

Participant Owner edits an existing Project
-------------------------------------------

Participant edits an existing Project
-------------------------------------

Participant create a Project Item
---------------------------------

Participant Invites Non Participant into Project
------------------------------------------------

Visitor Likes a Project
-----------------------



