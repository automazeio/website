import React from 'react';
import Layout from '../Components/Layout';

export default function Home({ title, message }) {
  return (
    <Layout>
      <div className="page-content">
        <h1>{title}</h1>
        <p>{message}</p>
        <div className="card">
          <h2>Features</h2>
          <ul>
            <li>Server-side routing with PHP</li>
            <li>Client-side rendering with React</li>
            <li>Seamless page transitions</li>
            <li>Shared data between server and client</li>
          </ul>
        </div>
      </div>
    </Layout>
  );
}