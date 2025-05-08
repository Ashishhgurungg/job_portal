<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apply for Job</title>
  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      line-height: 1.6;
    }
    
    /* Application form container */
    .application-container {
      max-width: 800px;
      margin: 40px auto;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }
    
    /* Header styles */
    .application-header {
      text-align: center;
      margin-bottom: 30px;
      border-bottom: 1px solid #eee;
      padding-bottom: 20px;
    }
    
    .application-header h1 {
      font-size: 28px;
      color: #2c3e50;
      margin-bottom: 10px;
      font-weight: 600;
    }
    
    .application-header h2 {
      font-size: 20px;
      color: #3498db;
      font-weight: 500;
    }
    
    /* Form styles */
    .application-form {
      display: flex;
      flex-direction: column;
    }
    
    .form-group {
      margin-bottom: 25px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #2c3e50;
      font-size: 16px;
    }
    
    .form-control {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 16px;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: #3498db;
      box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
      outline: none;
    }
    
    /* File upload styling */
    .file-upload {
      position: relative;
      display: inline-block;
      cursor: pointer;
      overflow: hidden;
      width: 100%;
    }
    
    .file-upload-label {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      background-color: #f1f8fe;
      border: 1px dashed #3498db;
      border-radius: 6px;
      color: #2c3e50;
      font-weight: 500;
      text-align: center;
      transition: all 0.3s ease;
    }
    
    .file-upload-label:hover {
      background-color: #e1f0fd;
    }
    
    .file-upload-icon {
      margin-right: 10px;
      font-size: 20px;
      color: #3498db;
    }
    
    .file-upload input[type="file"] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      opacity: 0;
      outline: none;
      cursor: pointer;
      display: block;
    }
    
    .file-name {
      margin-top: 8px;
      font-size: 14px;
      color: #666;
    }
    
    /* Textarea styling */
    textarea.form-control {
      min-height: 150px;
      resize: vertical;
    }
    
    /* Error message styling */
    .error-message {
      color: #e74c3c;
      font-size: 14px;
      margin-top: 6px;
      display: block;
    }
    
    /* Button styling */
    .submit-btn {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 14px 28px;
      font-size: 16px;
      font-weight: 500;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
      align-self: flex-start;
    }
    
    .submit-btn:hover {
      background-color: #2980b9;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .submit-btn:active {
      transform: translateY(0);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
      .application-container {
        margin: 20px 15px;
        padding: 20px;
      }
      
      .application-header h1 {
        font-size: 24px;
      }
      
      .application-header h2 {
        font-size: 18px;
      }
      
      .submit-btn {
        width: 100%;
      }
    }
    
    /* Animation for feedback */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
      animation: fadeIn 0.3s ease-in-out;
    }
  </style>
</head>
<body>
<x-app-layout>
  <div class="application-container animate-fade-in">
    <div class="application-header">
      <h1>Apply For Position</h1>
      <h2>{{ $job->title }}</h2>
    </div>

    <form action="/create-application/{{ $job->id }}" method="post" enctype="multipart/form-data" class="application-form">
      @csrf
      
      <div class="form-group">
        <label for="resume">Resume/CV</label>    
        <div class="file-upload">
          <label for="resume" class="file-upload-label">
            <span class="file-upload-icon">📄</span>
            <span>Choose your resume file</span>
          </label>
          <input type="file" name="resume" id="resume" class="form-control">
          <span class="file-name" id="file-name-display">No file chosen</span>
        </div>
        @error('resume')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="cover">Cover Letter</label>
        <textarea name="cover" id="cover" class="form-control" placeholder="Introduce yourself and explain why you're a good fit for this position..."></textarea>
        @error('cover')
          <span class="error-message">{{ $message }}</span>
        @enderror
      </div>

      <!-- Hidden select field for status -->
      <select id="status" name="status" hidden>
          <option value="0" selected>pending</option>
          <option value="1">Reviewing</option>
          <option value="2">Selected</option>
          <option value="3">Rejected</option>
      </select>

      <button type="submit" class="submit-btn">Submit Application</button>
    </form>
  </div>
  
  <script>
    // Display file name when selected
    document.getElementById('resume').addEventListener('change', function() {
      const fileName = this.files[0]?.name || 'No file chosen';
      document.getElementById('file-name-display').textContent = fileName;
    });
  </script>
</x-app-layout>
</body>
</html>