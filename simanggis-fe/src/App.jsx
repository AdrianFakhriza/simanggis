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

function App() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Rute untuk layout publik */}
        <Route element={<PublicLayout />}>
          <Route index element={<Home />} />
        </Route>

        {/* Rute untuk halaman admin */}

        <Route path="admin" element={<AdminLayout />}>
          <Route path="classes">
            <Route index element={<AdminClasses />} />
            <Route path="create" element={<ClassForm />} />
          </Route>

          <Route path="schools">
            <Route index element={<AdminSchools />} />
            <Route path="create" element={<SchoolForm />} />
            {/* Tambahkan rute lain untuk sekolah jika diperlukan */}
          </Route>
          <Route path="students">
            <Route index element={<AdminStudent />} />
            <Route path="create" element={<StudentForm />} />
          </Route>

          <Route path="teachers">
            <Route index element={<AdminTeacher />} />
            <Route path="create" element={< CreateTeacher />} />
        </Route>
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
