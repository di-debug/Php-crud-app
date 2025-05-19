# Answers to technical questions

---

### 1. How long did you spend on the coding test? What would you add to your solution if you had more time? If you didn't spend much time on the coding test then use this as an opportunity to explain what you would add.

- I spent approximately 3 day on the coding test i was stucked with error where Admin Panel Were unable to fetch the Data tried alot to debug after a while its fixed and Able to complete. And If I had more time, I would add the following improvements:
- Implement server-side and client-side validation for all forms, especially for file uploads.
- Add user authentication and authorization for the admin panel.
- Refactor the codebase to use a more structured MVC pattern.
- Add edit and delete functionality for both tabs and slides.
- Implement AJAX for a smoother user experience (e.g., adding tabs/slides without page reload).
- Write unit and integration tests.
- Add image/SVG preview before upload.
- Improve accessibility and responsive design.
- Add error handling and user-friendly feedback messages.

---

### 2. How would you track down a performance issue in production? Have you ever had to do this?

- To fix a performance issue in a live website or app, here’s what I usually do:

- First, I keep an eye on the basics — how much memory or CPU the server is using, how much data is going in and out, and whether anything looks off.

- Then, I check the error logs or any messages from the system to see if there are any slow pages or repeated problems.

- I also take a closer look at the code to see if something is taking too long — like a loop that’s doing too much work or a part of the code that’s being called too often.

- The database is often a common culprit, so I check if any searches or requests are taking longer than they should, or if the setup could be improved.

- If I can, I try to recreate the issue on a test version of the site so I can dig deeper without affecting real users.

- Once I find what’s slowing things down, I fix it — whether it’s rewriting some code, improving a database search, or adjusting the server setup.

- Yes, I’ve done this before — I’ve had to deal with slow-loading pages caused by heavy database use or poorly written code. Watching how things behave and checking logs helped me figure out what was wrong and fix it.

---

### 3. Please describe yourself using JSON.

```json
{
  "name": "Deepak Nandi",
  "City": "Guwhati, Assam",
  "role": "Frontend Developer",
  "skills": [
    "PHP",
    "JavaScript",
    "ReactJS"
    "NodeJs"
    "HTML",
    "CSS",
    "SQL",
    "MONGODB",
    "Debugging",
    "Code Review",
  ],
  "traits": [
    "helpful",
    "efficient",
    "collaborative",
    "detail-oriented",
    "Problem Solver",
    "Adaptive in Nature",
    "Team Player"
  ],
  "experience": "3+ Years of Experience in Frontend Development beside this I also manage Servers from Migration to Web Development and Web Design."
}
```