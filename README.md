# Getting Started

To get started with this project, follow these steps:

1. **Duplicate `.env.example` file**  
   Rename the file to `.env` and populate the environment variables to match your local setup for the project.

2. **Install dependencies**  
   Run the following command in the root directory of the project:
   ```bash
   composer install
   ```

3. **Install theme dependencies**  
   Navigate to `web/app/themes/sage-main` and run the following commands inside the theme's root directory:
   ```bash
   composer install
   yarn
   yarn build
   ```

4. **Build Gutenberg blocks**  
   For the Gutenberg blocks to work, you need to build them as well. Inside the theme, navigate to `resources/blocks` and run:
   ```bash
   npm install
   npm run build
   ```

You should now be up and running.

## Troubleshooting

If you encounter errors while launching the project, please refer to the following resources, as it's using [Bedrock](https://roots.io/bedrock/) and [Sage](https://roots.io/sage/) for the project setup:

- [Bedrock Installation Documentation](https://roots.io/bedrock/docs/installation/)
- [Sage Installation Documentation](https://roots.io/sage/docs/installation/)

### Gutenberg Blocks

For Gutenberg blocks, it uses the official [Create Block](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-create-block/) tool for scaffolding blocks, with minor modifications. Instead of being developed as a plugin, the blocks are incorporated directly into the theme.

