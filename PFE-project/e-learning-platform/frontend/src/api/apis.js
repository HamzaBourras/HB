// ------------------------Authentification------------------------------------------------------
export const LOGIN_API = "http://127.0.0.1:8000/api/login"
export const LOGOUT_API = "http://127.0.0.1:8000/api/logout"
export const UPDATE_PROFILE_API = "http://127.0.0.1:8000/api/auth/updateProfile"

export const FORGET_PASSWORD_API = "http://127.0.0.1:8000/api/forgotPassword"

// ****************************** DIRECTOR ****************************************************
export const GET_STATISTICS_API = "http://127.0.0.1:8000/api/auth/director/indexProfessorsStatistics"

//------------PROFESSORS-------------------------------------
export const ALL_PROFESSORS_API = "http://127.0.0.1:8000/api/auth/director/professor/index";
export const STORE_PROFESSOR_API = "http://127.0.0.1:8000/api/auth/director/professor/store";
export const UPDATE_PROFESSOR_API = "http://127.0.0.1:8000/api/auth/director/professor/edit";
export const DELETE_PROFESSOR_API = "http://127.0.0.1:8000/api/auth/director/professor/destroy";
// test
// export const STORE_PROFESSOR_API = "http://127.0.0.1:2000/api/posts/store";
// export const UPDATE_PROFESSOR_API = "http://127.0.0.1:2000/api/posts/update";
// export const DELETE_PROFESSOR_API = "http://127.0.0.1:2000/api/posts/delete";


//------------STUDENTS-------------------------------------
export const ALL_STUDENTS_API = "http://127.0.0.1:8000/api/auth/director/student/index";
export const STORE_STUDENT_API = "http://127.0.0.1:8000/api/auth/director/student/store";
export const UPDATE_STUDENT_API = "http://127.0.0.1:8000/api/auth/director/student/edit";
export const DELETE_STUDENT_API = "http://127.0.0.1:8000/api/auth/director/student/destroy";



//------------SECTORS-------------------------------------
export const ALL_SECTORS_API = "http://127.0.0.1:8000/api/auth/director/sector/index";
export const STORE_SECTOR_API = "http://127.0.0.1:8000/api/auth/director/sector/store";
export const UPDATE_SECTOR_API = "http://127.0.0.1:8000/api/auth/director/sector/edit";
export const DELETE_SECTOR_API = "http://127.0.0.1:8000/api/auth/director/sector/destroy";


//------------DEPARTMENTS-------------------------------------
export const ALL_DEPARTMENTS_API = "http://127.0.0.1:8000/api/auth/director/department/index";
export const STORE_DEPARTMENT_API = "http://127.0.0.1:8000/api/auth/director/department/store";
export const UPDATE_DEPARTMENT_API = "http://127.0.0.1:8000/api/auth/director/department/edit";
export const DELETE_DEPARTMENT_API = "http://127.0.0.1:8000/api/auth/director/department/destroy";


// ****************************** PROFESSOR ****************************************************

export const GET_PROFESSOR_STATISTICS_API = "http://127.0.0.1:8000/api/auth/professor/indexStudentsStatistics"


// --------------------------COURSE------------------------------------------------------
export const ALL_COURSES_API = "http://127.0.0.1:8000/api/auth/professor/courses/index";
export const STORE_COURSE_API = "http://127.0.0.1:8000/api/auth/professor/courses/store";
export const UPDATE_COURSE_API = "http://127.0.0.1:8000/api/auth/professor/courses/edit"
export const DELETE_COURSE_API = "http://127.0.0.1:8000/api/auth/professor/courses/destroy"

// -----------------------------STUDENT---------------------------------------------------
export const PROFESSOR_STUDENTS_API = "http://127.0.0.1:8000/api/auth/professor/students/index";


// -----------------------------ANNOUNCMENTS---------------------------------------------------
export const ALL_ANNOUNCEMENTS_API = "http://127.0.0.1:8000/api/auth/professor/announcements/index"
export const STORE_ANNOUNCEMENTS_API = "http://127.0.0.1:8000/api/auth/professor/announcements/store"
export const UPDATE_ANNOUNCEMENT_API = "http://127.0.0.1:8000/api/auth/professor/announcements/edit"
export const DELETE_ANNOUNCEMENT_API = "http://127.0.0.1:8000/api/auth/professor/announcements/destroy"

// -----------------------------QUIZZES---------------------------------------------------
export const ALL_QUIZZES_API = "http://127.0.0.1:8000/api/auth/professor/quizzes/index"
export const STORE_QUIZ_API = "http://127.0.0.1:8000/api/auth/professor/quizzes/store"
export const UPDATE_QUIZ_API = "http://127.0.0.1:8000/api/auth/professor/quizzes/edit"
export const DELETE_QUIZ_API = "http://127.0.0.1:8000/api/auth/professor/quizzes/destroy"

export const VIEW_SUBMITTED_STUDENT_QUIZ = "http://127.0.0.1:8000/api/auth/professor/quizzes/show"


// -----------------------------TASKS---------------------------------------------------
export const ALL_TASKS_API = "http://127.0.0.1:8000/api/auth/professor/tasks/index"
export const STORE_TASK_API = "http://127.0.0.1:8000/api/auth/professor/tasks/store"
export const UPDATE_TASK_API = "http://127.0.0.1:8000/api/auth/professor/tasks/edit"
export const DELETE_TASK_API = "http://127.0.0.1:8000/api/auth/professor/tasks/destroy"

export const VIEW_SUBMITTED_STUDENT_TASKS = "http://127.0.0.1:8000/api/auth/professor/tasks/show"


// ****************************** STUDENT ****************************************************

// -----------------------------SUBMISSIONS---------------------------------------------------
export const ALL_SUBMISSIONS_API = "http://127.0.0.1:8000/api/auth/student/submissions/indexTasks"
export const STORE_SUBMISSION_API = "http://127.0.0.1:8000/api/auth/student/submissions/store"
export const UPDATE_SUBMISSION_API = "http://127.0.0.1:8000/api/auth/student/submissions/edit"
export const DELETE_SUBMISSION_API = "http://127.0.0.1:8000/api/auth/student/submissions/destroy"

export const GET_SUBMISSION_API = "http://127.0.0.1:8000/api/auth/student/submissions/index"

// -----------------------------MyProfessors---------------------------------------------------
export const MY_PROFESSORS_API = "http://127.0.0.1:8000/api/auth/student/professors/index"

// -----------------------------COURSES---------------------------------------------------
export const STUDENT_COURSES_API = "http://127.0.0.1:8000/api/auth/student/courses/index"

// -----------------------------GRADES---------------------------------------------------
export const STUDENT_GRADES_API = "http://127.0.0.1:8000/api/auth/student/grades/index"

// -----------------------------GRADES---------------------------------------------------
export const STUDENT_ANNOUNCEMENTS_API = "http://127.0.0.1:8000/api/auth/student/announcements/index"

// -----------------------------QUIZZES---------------------------------------------------
export const ALL_STUDENT_QUIZZES_API = "http://127.0.0.1:8000/api/auth/student/quizzes/index"
export const SUBMIT_STUDENT_QUIZ_API = "http://127.0.0.1:8000/api/auth/student/quizzes/store"


















