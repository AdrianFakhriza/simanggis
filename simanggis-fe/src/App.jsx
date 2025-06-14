import { BrowserRouter, Route, Routes } from "react-router-dom";
import PublicLayout from "./layouts/public";

function App() {
  return (
    <>
    <BrowserRouter>
      <Routes>

        {/* Public */}
        <Route index element={<PublicLayout/>}>
            
        </Route>

       </Routes>
      </BrowserRouter>
    </>
  );
}

export default App;