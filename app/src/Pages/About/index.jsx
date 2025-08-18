import React from 'react';
import Layout from '../../Components/Layout';

export default function About({ title, content, team }) {
  return (
    <Layout>
      <div className="page-content">
        <h1>{title}</h1>
        <p>{content}</p>

        <div className="team-section">
          <h2>Our Team</h2>
          <div className="team-grid">
            {team.map((member, index) => (
              <div key={index} className="team-member">
                <h3>{member.name}</h3>
                <p>{member.role}</p>
              </div>
            ))}
          </div>
          <div className="team-link">
            <a href="/react/about/team" className="button-link">
              View Full Team Profiles →
            </a>
          </div>
        </div>
      </div>
    </Layout>
  );
}
