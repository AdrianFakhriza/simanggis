import { Outlet } from "react-router-dom";
import { Link } from "react-router-dom";

export default function AdminLayout() {
  return (
    <div className="min-h-screen antialiased bg-gray-100 dark:bg-gray-900">
      <nav className="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
        <div className="flex flex-wrap items-center justify-between">
          <div className="flex items-center justify-start">
            <button
              data-drawer-target="drawer-navigation"
              data-drawer-toggle="drawer-navigation"
              aria-controls="drawer-navigation"
              className="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-blue-600 hover:bg-blue-50 focus:bg-blue-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-blue-200 dark:focus:ring-blue-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >
              <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fillRule="evenodd" d="M3 5h14M3 10h14M3 15h14" clipRule="evenodd" />
              </svg>
              <span className="sr-only">Toggle Sidebar</span>
            </button>
            <Link to="/" className="flex items-center justify-between mr-4">
              <img
                src="https://flowbite.s3.amazonaws.com/logo.svg"
                className="mr-3 h-9"
                alt="Logo"
              />
              <span className="self-center text-2xl font-bold tracking-tight text-blue-700 dark:text-white">
                Simanggis
              </span>
            </Link>
          </div>
          <div className="flex items-center lg:order-2">
            <button
              type="button"
              className="flex mx-3 text-sm bg-blue-100 rounded-full dark:bg-blue-900 md:mr-0 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-600"
              id="user-menu-button"
              aria-expanded="false"
              data-dropdown-toggle="dropdown"
            >
              <span className="sr-only">Open user menu</span>
              <img
                className="border-2 border-white rounded-full w-9 h-9"
                src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png"
                alt="user photo"
              />
            </button>
            <span className="hidden mr-4 font-semibold text-gray-700 md:block dark:text-gray-200">Neil Sims</span>
          </div>
        </div>
      </nav>

      <aside
        className="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-blue-300 pt-14 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidenav"
        id="drawer-navigation"
      >
        <div className="h-full px-3 py-5 overflow-y-auto">
          <ul className="space-y-2">
            <li>
              <Link to="/admin" className="flex items-center p-2 text-base font-semibold text-blue-700 rounded-lg hover:bg-blue-100 dark:text-blue-200 dark:hover:bg-gray-700">
                <svg className="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0l-7 7-2-2" />
                </svg>
                <span className="ml-3">Dashboard</span>
              </Link>
            </li>
            <li>
              <Link to="/admin/users" className="flex items-center p-2 text-base font-semibold text-blue-700 rounded-lg hover:bg-blue-100 dark:text-blue-200 dark:hover:bg-gray-700">
                <svg className="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M4 20h5v-2a4 4 0 00-3-3.87M12 12a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
                <span className="ml-3">Users</span>
              </Link>
            </li>
            <li>
              <Link to="/admin/schools" className="flex items-center p-2 text-base font-semibold text-blue-700 rounded-lg hover:bg-blue-100 dark:text-blue-200 dark:hover:bg-gray-700">
                <svg className="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M3 10l9-7 9 7-9 7-9-7z" />
                  <path d="M9 21V12h6v9" />
                </svg>
                <span className="ml-3">Data Sekolah</span>
              </Link>
            </li>
            <li>
              <Link to="/admin/classes" className="flex items-center p-2 text-base font-semibold text-blue-700 rounded-lg hover:bg-blue-100 dark:text-blue-200 dark:hover:bg-gray-700">
                <svg className="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span className="ml-3">Daftar Kelas</span>
              </Link>
            </li>
          </ul>

          <ul className="pt-5 mt-5 space-y-2 border-t border-blue-200">
            <li>
              <Link to="/admin/students" className="flex items-center p-2 text-base font-semibold text-blue-700 rounded-lg hover:bg-blue-100 dark:text-blue-200 dark:hover:bg-gray-700">
                <svg className="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M16 14c2.21 0 4 1.79 4 4v1H4v-1c0-2.21 1.79-4 4-4h8zM12 12a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
                <span className="ml-3">Daftar Siswa</span>
              </Link>
            </li>
            <li>
              <Link to="/admin/teachers" className="flex items-center p-2 text-base font-semibold text-blue-700 rounded-lg hover:bg-blue-100 dark:text-blue-200 dark:hover:bg-gray-700">
                <svg className="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M8 16v1a4 4 0 004 4 4 4 0 004-4v-1M12 12a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
                <span className="ml-3">Daftar Guru</span>
              </Link>
            </li>
            <li>
              <Link to="/help" className="flex items-center p-2 text-base font-semibold text-blue-700 rounded-lg hover:bg-blue-100 dark:text-blue-200 dark:hover:bg-gray-700">
                <svg className="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M12 8v4m0 4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                </svg>
                <span className="ml-3">Help</span>
              </Link>
            </li>
          </ul>
        </div>
      </aside>

      <main className="h-auto p-4 pt-20 transition md:ml-64">
        <div className="h-auto px-4 pt-4 pb-6 bg-white border-2 border-blue-100 rounded-2xl dark:border-blue-900 dark:bg-gray-900">
          <Outlet />
        </div>
      </main>
    </div>
  );
}
