import { useLocation } from 'react-router-dom';
import { useRef } from 'react';
import { useReactToPrint } from 'react-to-print';

const ResumePreview = () => {
  const location = useLocation();
  const formData = location.state; // Data from form submission
  const componentRef = useRef();

  const handlePrint = useReactToPrint({
    content: () => componentRef.current,
  });

  return (
    <div>
      <div ref={componentRef} className="resume-container">
        <h1>Resume</h1>
        <h2>Professional Summary</h2>
        <p>{formData.summary}</p>

        <h2>Education</h2>
        <p>{formData.education}</p>

        <h2>Skills</h2>
        <p>{formData.skills}</p>

        <h2>Career Objective</h2>
        <p>{formData.careerObjective}</p>

        <h2>Experience and Internships</h2>
        <p>{formData.experience}</p>

        <h2>Skills and Achievements</h2>
        <p>{formData.achievements}</p>
      </div>

      <button onClick={handlePrint}>Download as PDF</button>
    </div>
  );
};

export default ResumePreview;
