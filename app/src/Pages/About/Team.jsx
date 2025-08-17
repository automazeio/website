import React from 'react';
import Layout from '../../Components/Layout';

export default function Team({ title, description, teamMembers }) {
  return (
    <Layout>
      <div className="page-content">
        <h1>{title}</h1>
        <p className="page-description">{description}</p>
        
        <div className="team-grid-full">
          {teamMembers.map((member) => (
            <div key={member.id} className="team-card">
              <img 
                src={member.image} 
                alt={member.name}
                className="team-avatar"
              />
              <div className="team-info">
                <h3>{member.name}</h3>
                <p className="team-role">{member.role}</p>
                <p className="team-bio">{member.bio}</p>
                <div className="social-links">
                  {Object.entries(member.social).map(([platform, url]) => (
                    <a 
                      key={platform}
                      href={url}
                      target="_blank"
                      rel="noopener noreferrer"
                      className={`social-link ${platform}`}
                      title={`Visit ${member.name} on ${platform}`}
                    >
                      {platform}
                    </a>
                  ))}
                </div>
              </div>
            </div>
          ))}
        </div>
        
        <div className="breadcrumb">
          <a href="/about">← Back to About</a>
        </div>
      </div>
    </Layout>
  );
}