import { BrowserRouter, Routes, Route } from "react-router-dom";
import PublicLayout from "./layouts/public";
import Home from "./pages/public";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        {/* Rute untuk layout publik */}
        <Route element={<PublicLayout />}>
          <Route index element={<Home />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
