import { BrowserRouter, Routes, Route } from "react-router-dom";
import PublicLayout from "./layouts/public";
import Home from "./pages/public";
import AdminLayout from "./layouts/admin";
import AdminClasses from "./pages/admin/classes";
import ClassForm from "./pages/admin/classes/create";
import AdminSchools from "./pages/admin/schools";
import SchoolForm from "./pages/admin/schools/create";
import AdminStudent from "./pages/admin/students";
import StudentForm from "./pages/admin/students/create";
import AdminTeacher from "./pages/admin/teachers";
import CreateTeacher from "./pages/admin/teachers/create";
import EditTeacher from "./pages/admin/teachers/edit";
import Login from "./pages/auth/login";
import StudentDetail from "./pages/admin/students/detail";
import EditStudent from "./pages/admin/students/edit";
import EditSchool from "./pages/admin/schools/detail";
import SchoolIndex from "./pages/public/schools";
import SchoolShow from "./pages/public/schools/show";
<<<<<<< HEAD
=======
import About from "./pages/public/about";
>>>>>>> ffaac75757a68fc2ef76354c5d20166f5a208353

// Import guard route
import PrivateRoute from "./components/privateRoute";
import GuestRoute from "./components/guestRoute";
import EditClass from "./pages/admin/classes/edit";
import ClassDetailPage from "./pages/admin/classes/detail";
import Dashboard from "./pages/admin/dashboard";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Rute untuk layout publik */}
        <Route element={<PublicLayout />}>
          <Route index element={<Home />} />
          <Route path="schools" element={<SchoolIndex />} />
          <Route path="schools/:id" element={<SchoolShow />} />
<<<<<<< HEAD
=======
          <Route path="about" element={<About />} />
>>>>>>> ffaac75757a68fc2ef76354c5d20166f5a208353
        </Route>

        {/* Rute untuk halaman admin yang diproteksi */}
        {/* admin */}
        <Route
          path="admin"
          element={
            <PrivateRoute>
              <AdminLayout />
            </PrivateRoute>
          }
        >
          {/* Admin Route */}
          <Route index element={<Dashboard />} />
          {/* admin/classes */}
          <Route path="classes">
            <Route index element={<AdminClasses />} />
            <Route path="create" element={<ClassForm />} />
            <Route path="detail/:id" element={<ClassDetailPage />} />
            <Route path="edit/:id" element={<EditClass />} />
          </Route>

          {/* admin/schools */}
          <Route path="schools">
            <Route index element={<AdminSchools />} />
            <Route path="create" element={<SchoolForm />} />
            <Route path="detail" element={<EditSchool />} />
          </Route>

          {/* admin/classes */}

          <Route path="students">
            <Route index element={<AdminStudent />} />
            <Route path="create" element={<StudentForm />} />
            <Route path="detail/:id" element={<StudentDetail />} />
            <Route path="edit/:id" element={<EditStudent />} />
          </Route>

          <Route path="teachers">
            <Route index element={<AdminTeacher />} />
            <Route path="create" element={<CreateTeacher />} />
            <Route path="edit/:id" element={<EditTeacher />} />
          </Route>
        </Route>

        {/* Rute login hanya untuk tamu */}
        <Route
          path="login"
          element={
            <GuestRoute>
              <Login />
            </GuestRoute>
          }
        />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
