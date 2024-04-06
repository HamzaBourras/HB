import { Route, Routes, Navigate } from 'react-router-dom';
// layouts

import GuestLayout from './layouts/GuestLayout';
import AuthLayout from './layouts/AuthLayout';

import StudentLayout from './layouts/User/StudentLayout';
import ProfessorLayout from './layouts/User/ProfessorLayout';
import DirectorLayout from './layouts/User/DirectorLayout';

// Not found page
import NotFound from './layouts/User/NotFound';

// Director pages
import DirectorDashboard from './pages/director/DirectorDashboard';
import ManageProfessors from './pages/director/ManageProfessors';
import ManageDepartments from './pages/director/ManageDepartments';
import EditData from './pages/director/EditData';
import ManageStudents from './pages/director/ManageStudents';
import ManageSectors from './pages/director/ManageSectors';
import DirectorProfile from './pages/director/DirectorProfile';

// Professor pages
import ProfessorDashboard from './pages/professor/ProfessorDashboard';
import ManageCourses from './pages/professor/ManageCourses';
import ManageMyStudents from './pages/professor/ManageMyStudents'
import ManageAnnouncements from './pages/professor/ManageAnnouncements'
import ManageQuizzes from './pages/professor/ManageQuizzes'
import ManageSubmissions from './pages/professor/ManageTasks'
import ProfessorProfile from './pages/professor/ProfessorProfile';

// student pages
import StudentDashboard from './pages/student/StudentDashboard'
import StudentTasks from './pages/student/StudentTasks'
import StudentCourses from './pages/student/StudentCourses'
import StudentProfile from './pages/student/StudentProfile';
import StudentGrades from './pages/student/StudentGrades';
import StudentQuizzes from './pages/student/StudentQuizzes';
import ProfessorMeeting from './pages/professor/ProfessorMeeting';
import ResultComponent from './pages/professor/components/ResultComponent';



const App = () => {
  return (
    <>
      <Routes>
        <Route path="/" index element={<GuestLayout />} />

        <Route path="/auth" element={<AuthLayout />}>
          {/* --------- --  -- - -- -Student Part -- - -- - - - -- - - - --  --  */}
          <Route path="student" element={<StudentLayout />} >
            <Route index element={<Navigate to="dashboard" replace />} />
            <Route path="dashboard" element={<StudentDashboard />} />
            <Route path="submissions" element={<StudentTasks />} />
            <Route path="courses" element={<StudentCourses />} />
            <Route path="quizzes" element={<StudentQuizzes/>} />
            <Route path="grades" element={<StudentGrades />} />
            <Route path="profile" element={<StudentProfile/>} />
          </Route>

          {/* --------- --  -- - -- -Professor Part -- - -- - - - -- - - - --  --  */}
          <Route path="professor" element={<ProfessorLayout />} >
            <Route index element={<Navigate to="dashboard" replace />} />
            <Route path='dashboard' element={<ProfessorDashboard />} />
            <Route path='courses' element={<ManageCourses />} />
            <Route path='my-students' element={<ManageMyStudents />} />
            <Route path='result/:name/:id' element={<ResultComponent />} />
            <Route path='announcements' element={<ManageAnnouncements />} />
            <Route path='quizzes' element={<ManageQuizzes />} />
            <Route path='tasks' element={<ManageSubmissions />} />
            <Route path="profile" element={<ProfessorProfile/>} />
            <Route path="meeting" element={<ProfessorMeeting/>} />
          </Route>



          {/* --------- --  -- - Director Part-- - -- - -- - - - -- - */}
          <Route path="director" element={<DirectorLayout />} >
            <Route index element={<Navigate to="dashboard" replace />} />
            <Route path='dashboard' element={<DirectorDashboard />} />
            <Route path='professors' element={<ManageProfessors />} />
            <Route path='departments' element={<ManageDepartments />} />
            <Route path='sectors' element={<ManageSectors />} />
            <Route path='students' element={<ManageStudents />} />
            <Route path='edit' element={<EditData />} />
            <Route path='profile' element={<DirectorProfile />} />
          </Route>
        </Route>

        <Route path='*' element={<NotFound />} />

      </Routes>
    </>
  );
};

export default App;
