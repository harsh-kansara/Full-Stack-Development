// src/ResumeBuilder.js
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import './ResumeBuilder.css';

const ResumeBuilder = () => {
  const [formData, setFormData] = useState({
    professionalSummary: '',
    careerObjective: '',
    education: '',
    skills: '',
    experience: '',
    achievements: '',
  });

  const navigate = useNavigate();

  const [successMessage, setSuccessMessage] = useState('');

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (Object.values(formData).every(field => field !== '')) {
      setSuccessMessage('Resume created successfully!');
      setFormData({
        professionalSummary: '',
        careerObjective: '',
        education: '',
        skills: '',
        experience: '',
        achievements: '',
      });
    } else {
      setSuccessMessage('Please fill in all fields');
    }

    navigate('/resume', { state: formData });
  };

  return (
    <div className="resume-container">
      <h1>Resume Builder</h1>
      <form onSubmit={handleSubmit} className="resume-form">
        <div className="form-group">
          <label>Professional Summary</label>
          <textarea
            name="professionalSummary"
            value={formData.professionalSummary}
            onChange={handleChange}
            rows="4"
            placeholder="Write a brief professional summary"
          />
        </div>

        <div className="form-group">
          <label>Career Objective</label>
          <textarea
            name="careerObjective"
            value={formData.careerObjective}
            onChange={handleChange}
            rows="3"
            placeholder="Describe your career objective"
          />
        </div>

        <div className="form-group">
          <label>Education</label>
          <textarea
            name="education"
            value={formData.education}
            onChange={handleChange}
            rows="4"
            placeholder="List your educational qualifications"
          />
        </div>

        <div className="form-group">
          <label>Skills (Academic & Non-academic)</label>
          <textarea
            name="skills"
            value={formData.skills}
            onChange={handleChange}
            rows="4"
            placeholder="Mention your academic and non-academic skills"
          />
        </div>

        <div className="form-group">
          <label>Experience & Internships</label>
          <textarea
            name="experience"
            value={formData.experience}
            onChange={handleChange}
            rows="4"
            placeholder="Describe your experience and internships"
          />
        </div>

        <div className="form-group">
          <label>Achievements</label>
          <textarea
            name="achievements"
            value={formData.achievements}
            onChange={handleChange}
            rows="3"
            placeholder="List your achievements"
          />
        </div>

        <button type="submit">Generate Resume</button>
      </form>

      {successMessage && <div className="success-message">{successMessage}</div>}
    </div>
  );
};

export default ResumeBuilder;
