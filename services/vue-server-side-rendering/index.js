const { createBundleRenderer } = require('vue-server-renderer');
const fs = require('fs');
const path = require('path');

function getFreshRenderer() {
	let serverBundleStats = fs.lstatSync('../../public/vue-ssr-server-bundle.json');
	
	if (getFreshRenderer.renderer && getFreshRenderer.serverBundleTime === serverBundleStats.mtimeMs) {
		return getFreshRenderer.renderer;
	}
	
	let serverBundle = JSON.parse(fs.readFileSync('../../public/vue-ssr-server-bundle.json').toString());
	let clientManifest = JSON.parse(fs.readFileSync('../../public/vue-ssr-client-manifest.json').toString());
	
	getFreshRenderer.renderer = createBundleRenderer(serverBundle, {
		runInNewContext: false,
		clientManifest,
		inject: false,
	});
	
	getFreshRenderer.serverBundleTime = serverBundleStats.mtimeMs;
	console.log('Bundle was updated!');
	return getFreshRenderer.renderer;
}

getFreshRenderer();

// ---------------------------------------------------------------------- //

const express = require('express');
const bodyParser = require('body-parser');
const port = parseInt(process.argv[2] || '32452');
const server = express();
server.use(bodyParser.json());

server.post('/', (request, response) => {
	let startTime = Date.now();
	let context = request.body;
	
	return getFreshRenderer().renderToString(context, (error, outlet) => {
		if (error) {
			console.error(context.url, error.stack);
			return response.status(500).send({ error });
		}
		
		let executionTime = Date.now() - startTime;
		console.log('OK', 'Time:', executionTime);
		
		return response.send({
			outlet,
			resourceHints: context.renderResourceHints(),
			scripts: context.renderScripts(),
			styles: context.renderStyles(),
			executionTime,
		});
	});
});

server.listen(port, () => {
	console.log(`Listening #${port} port...`);
});

process.on('unhandledRejection', error => {
	if (error.name === 'NavigationDuplicated') {
		return;
	}
	
	console.error('[unhandledRejection]', error);
});