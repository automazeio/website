import React from 'react';
import { useNavigate } from '../app';

export default function Layout({ children }) {
  const navigate = useNavigate();
  
  const handleLinkClick = (url) => (e) => {
    navigate(url, e);
  };

  return (
    <div className="app-layout">
      <header>
        <nav>
          <div className="nav-brand">
            <h2>PHP React SPA</h2>
          </div>
          <ul className="nav-links">
            <li>
              <a href="/" onClick={handleLinkClick('/')}>
                Home
              </a>
            </li>
            <li>
              <a href="/about" onClick={handleLinkClick('/about')}>
                About
              </a>
            </li>
            <li>
              <a href="/contact" onClick={handleLinkClick('/contact')}>
                Contact
              </a>
            </li>
          </ul>
        </nav>
      </header>
      
      <main>
        {children}
      </main>
      
      <footer>
        <p>&copy; 2024 PHP React SPA Demo. Built with pure PHP and React (no frameworks).</p>
      </footer>
    </div>
  );
}