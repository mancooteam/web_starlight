// Accessing the variables you defined in the YAML 'env' section
const dbPassword = process.env.DB_PASSWORD;
const dbHost = process.env.SERVER_LINK;

// Example usage (don't console.log the password in real life!)
console.log(`Attempting to connect to host: ${dbHost}`);

// Your database connection logic here...
alert("Connected to database");