import React, { useState, useEffect, createContext, useContext, lazy, Suspense } from 'react';
import { createRoot } from 'react-dom/client';

// Dynamically load page components
const pageComponents = {};

const loadPageComponent = (name) => {
  // Cache the lazy-loaded component
  if (!pageComponents[name]) {
    pageComponents[name] = lazy(() => {
      // First try with .jsx extension explicitly
      return import(
        /* webpackInclude: /\.jsx$/ */
        `./Pages/${name}.jsx`
      ).catch((error) => {
        // Then try without extension (for folders)
        return import(
          /* webpackInclude: /\.jsx$/ */
          `./Pages/${name}`
        );
      }).catch((error) => {
        // Finally try index file
        return import(
          /* webpackInclude: /\.jsx$/ */
          `./Pages/${name}/index.jsx`
        );
      }).catch((error) => {
        console.error(`❌ Component "${name}" not found`);
        return {
          default: () => (
            <div className="error-container">
              <h2>Page Not Found</h2>
              <p>Component "{name}" could not be loaded.</p>
            </div>
          )
        };
      });
    });
  }

  return pageComponents[name];
};

// Create a navigation context so any component can navigate
const NavigationContext = createContext();

// Hook to use navigation anywhere in the app
export const useNavigate = () => useContext(NavigationContext);

// Loading component shown while chunks are being fetched
function LoadingSpinner() {
  return (
    <div className="loading-container">
      <div className="spinner"></div>
      <p>Loading...</p>
    </div>
  );
}

// Error boundary to catch chunk loading failures
class ErrorBoundary extends React.Component {
  constructor(props) {
    super(props);
    this.state = { hasError: false };
  }

  static getDerivedStateFromError(error) {
    return { hasError: true };
  }

  componentDidCatch(error, errorInfo) {
    console.error('Chunk loading error:', error, errorInfo);
  }

  render() {
    if (this.state.hasError) {
      return (
        <div className="error-container">
          <h2>Failed to load page</h2>
          <p>Please refresh the page to try again.</p>
          <button onClick={() => window.location.reload()}>Refresh</button>
        </div>
      );
    }

    return this.props.children;
  }
}

function App({ initialPage }) {
  const [currentPage, setCurrentPage] = useState(initialPage);
  const [isNavigating, setIsNavigating] = useState(false);

  // Update document title and meta tags when page changes
  useEffect(() => {
    const props = currentPage.props || {};
    const meta = props.meta || {};

    // Update document title
    const title = meta.title || props.title || 'PHP React SPA Demo';
    document.title = title;

    // Helper function to update or create meta tags
    const updateMetaTag = (selector, content) => {
      if (!content) return;

      let element = document.querySelector(selector);
      if (!element) {
        // Create the meta tag if it doesn't exist
        element = document.createElement('meta');
        const isProperty = selector.includes('property=');

        if (isProperty) {
          element.setAttribute('property', selector.match(/property="([^"]+)"/)[1]);
        } else {
          element.setAttribute('name', selector.match(/name="([^"]+)"/)[1]);
        }
        document.head.appendChild(element);
      }

      element.content = content;
    };

    // Update all meta tags
    const description = meta.description || props.message || props.content || 'A modern SPA built with PHP and React';

    updateMetaTag('meta[name="description"]', description);
    updateMetaTag('meta[property="og:title"]', meta.og_title || meta.title || title);
    updateMetaTag('meta[property="og:description"]', meta.og_description || description);
    updateMetaTag('meta[property="og:url"]', window.location.href);
    updateMetaTag('meta[property="og:image"]', meta.og_image);
    updateMetaTag('meta[name="twitter:title"]', meta.twitter_title || meta.title || title);
    updateMetaTag('meta[name="twitter:description"]', meta.twitter_description || description);
    updateMetaTag('meta[name="twitter:image"]', meta.twitter_image || meta.og_image);

    // While these meta tag updates won't help with social sharing (crawlers don't run JS),
    // they do help with:
    // 1. Browser extensions that read meta tags
    // 2. Debugging tools that inspect current meta tags
    // 3. Any JavaScript that reads these tags
    // 4. Maintaining consistency in the DOM
  }, [currentPage]);

  // Handle navigation
  const navigate = async (url, e) => {
    if (e) {
      e.preventDefault();
    }
    
    // Show loading state
    setIsNavigating(true);

    try {
      // Fetch page data from server
      const response = await fetch(url, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'X-SPA-Request': 'true'
        }
      });

      if (response.ok) {
        const pageData = await response.json();
        
        // Update current page state
        setCurrentPage(pageData);

        // Update browser URL without page reload
        window.history.pushState(pageData, '', url);
      } else {
        console.error(`❌ Navigation failed: ${response.status} ${response.statusText}`);
      }
    } catch (error) {
      console.error('❌ Navigation error:', error);
    } finally {
      setIsNavigating(false);
    }
  };

  // Handle browser back/forward buttons
  useEffect(() => {
    const handlePopState = (event) => {
      if (event.state) {
        setCurrentPage(event.state);
      }
    };

    window.addEventListener('popstate', handlePopState);

    // Set initial state
    window.history.replaceState(currentPage, '', window.location.pathname);

    return () => {
      window.removeEventListener('popstate', handlePopState);
    };
  }, []);

  // Dynamically load the component
  const PageComponent = loadPageComponent(currentPage.component);

  // Provide navigation context to all components
  return (
    <NavigationContext.Provider value={navigate}>
      <ErrorBoundary>
        <Suspense fallback={<LoadingSpinner />}>
          {isNavigating && (
            <div className="navigation-loading">
              <div className="progress-bar"></div>
            </div>
          )}
          <PageComponent {...currentPage.props} />
        </Suspense>
      </ErrorBoundary>
    </NavigationContext.Provider>
  );
}

// Initialize the app
document.addEventListener('DOMContentLoaded', () => {
  // Get page data from the JSON script tag
  const pageDataElement = document.getElementById('page-data');
  const pageData = JSON.parse(pageDataElement.textContent);

  // Remove the script tag now that we have the data
  pageDataElement.remove();

  // Hide pre-rendered HTML if it exists (for SEO)
  const prerenderedElement = document.getElementById('prerenderd-html');
  if (prerenderedElement) {
    prerenderedElement.style.visibility = 'hidden';
    prerenderedElement.style.position = 'absolute';
    prerenderedElement.style.zIndex = '-1';
    prerenderedElement.style.pointerEvents = 'none';
  }

  // Mount React app
  const rootElement = document.getElementById('app');
  const root = createRoot(rootElement);
  root.render(<App initialPage={pageData} />);
});
