const express = require("express");
const apicache = require("apicache");
const v1MaquinaRouter = require("./v1/routes/maquinaRoutes");
const v1ProductesRouter = require("./v1/routes/producteRoutes");

const app = express();
const PORT = process.env.PORT || 3000;
const cache = apicache.middleware;

app.use(express.json());
app.use(cache("2 minutes"));
app.use("/api/v1/maquines", v1MaquinaRouter);
app.use("/api/v1/productes", v1ProductesRouter);

app.listen(PORT, () => {
  console.log(`🚀 Server listening on port ${PORT}`);
});
