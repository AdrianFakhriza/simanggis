import { Link } from "react-router-dom";

export default function Navbar() {
  return (
    <header>
      <nav className="bg-[#FFF8E1] shadow-lg px-6 py-3">
        <div className="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
          <Link to="/" className="flex items-center gap-4">
            <img
              src="https://flowbite.com/docs/images/logo.svg"
              className="h-6 mr-3 sm:h-9"
              alt="Flowbite Logo"
            />
            <span classpName="self-center text-xl font-bold tracking-widest text-blue-900 leading-tight border-l-4 border-blue-900 pl-4 drop-shadow">
              SIMANGGIS
            </span>
          </Link>
          <div className="flex items-center gap-8">
            <Link
              to="/"
              className="text-lg font-semibold text-blue-900 transition-colors hover:text-yellow-700"
            >
              Home
            </Link>
            <Link
              to="/riwayat"
              className="text-lg font-semibold text-blue-900 transition-colors hover:text-yellow-700"
            >
              Team
            </Link>
            <Link
              to="/"
              className="relative inline-block px-6 py-2 text-lg font-bold text-blue-900 transition-all duration-300 border-2 border-blue-500 rounded-full shadow-lg bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:from-yellow-700 hover:via-yellow-800 hover:to-yellow-900 hover:text-blue-200 hover:border-yellow-800 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
              <span className="flex items-center gap-2">
                <svg
                  className="w-5 h-5"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                  />
                </svg>
                LOGIN
              </span>
            </Link>
            <Link
              to="/register"
              className="relative inline-block px-8 py-2 text-lg font-bold text-blue-900 transition-all duration-300 border-2 border-yellow-500 rounded-full shadow-lg bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:from-blue-700 hover:via-blue-800 hover:to-blue-900 hover:text-yellow-200 hover:border-blue-800 focus:outline-none focus:ring-2 focus:ring-yellow-400"
            >
              <span className="flex items-center gap-2">
                <svg
                  className="w-5 h-5"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    d="M12 4v16m8-8H4"
                  />
                </svg>
                DAFTAR
              </span>
            </Link>
          </div>
        </div>
      </nav>
    </header>
  );
}
