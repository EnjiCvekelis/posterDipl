<template>
    <div class="dropzone"
         v-on:drop="dropHandler"
         v-on:dragover="dragOverHandler"
         v-on:click="clickHandler"
    >
        <input type="file" style="display: none" id="vue-dropzone-input">
        <div class="dropzone__img-container">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px"
                 width="393.85px" height="393.85px" viewBox="0 0 393.85 393.85"
                 style="enable-background:new 0 0 393.85 393.85;"
                 xml:space="preserve">
<g>
	<path d="M306.979,144.593c-16.921-26.564-46.168-42.779-78.009-42.779c-4.252,0-8.498,0.291-12.697,0.869
		c-17.287-23.797-45.246-38.258-74.926-38.258c-50.474,0-91.635,40.64-92.484,90.917C18.917,171.333,0,202.481,0,236.926
		c0,51.004,41.495,92.499,92.499,92.499h208.852c51.004,0,92.499-41.495,92.499-92.499
		C393.85,187.81,355.374,147.512,306.979,144.593z M301.351,304.425h-91.926V196.4l38.661,38.659c4.882,4.882,12.797,4.882,17.678,0
		s4.881-12.796,0-17.678l-60-59.998c-4.881-4.88-12.795-4.881-17.678,0l-60,60c-4.881,4.882-4.881,12.796,0,17.679
		c2.441,2.439,5.64,3.66,8.839,3.66s6.398-1.221,8.839-3.66l38.661-38.662v108.025H92.499C55.28,304.425,25,274.146,25,236.926
		c0-27.28,16.258-51.726,41.419-62.278c4.965-2.083,8.04-7.11,7.629-12.479c-0.132-1.721-0.198-3.484-0.198-5.243
		c0-37.22,30.279-67.5,67.497-67.5c23.843,0,46.167,12.795,58.261,33.392c2.781,4.736,8.325,7.104,13.674,5.831
		c5.113-1.217,10.393-1.834,15.688-1.834c25.079,0,47.953,13.786,59.698,35.979c2.211,4.178,6.585,6.772,11.315,6.65
		c0.456-0.01,0.909-0.02,1.366-0.02c37.22,0,67.499,30.281,67.499,67.502C368.85,274.146,338.569,304.425,301.351,304.425z"/>
</g>
</svg>
        </div>
        <div class="dropzone__text">
            {{inputText}}
        </div>
    </div>
</template>

<script>
    export default {
        name: "dropzone",
        props: {
            inputText: {
                default: "Choose or drop files to upload"
            }
        },
        data() {
            return {
                images: Array
            }
        },
        methods: {
            sendFiles(file) {
                this.$emit('file', file);
            },

            readFile(file) {
                const reader = new FileReader();
                reader.onload = (evt) => {
                    this.sendFiles(evt.target.result)
                };
                reader.readAsDataURL(file);
            },

            clickHandler() {
                let input = document.getElementById("vue-dropzone-input");
                input.setAttribute("type", "file");
                input.setAttribute("accept", "image/*");
                input.setAttribute("multiple", "multiple");
                input.onchange = (e) => {
                    for (let i = 0; i < e.target.files.length; i++) {
                        this.readFile(e.target.files[i]);
                    }
                };
                input.click();
            },

            dropHandler(e) {
                e.preventDefault();
                if (e.dataTransfer.items) {
                    // Use DataTransferItemList interface to access the file(s)
                    for (var i = 0; i < e.dataTransfer.items.length; i++) {
                        // If dropped items aren't files, reject them
                        if (e.dataTransfer.items[i].kind === 'file') {
                            let file = e.dataTransfer.items[i].getAsFile();
                            if (file.type.indexOf("image/") < 0) continue;
                            this.readFile(file);
                        }
                    }
                } else {
                    for (var i = 0; i < e.dataTransfer.files.length; i++) {
                        if (e.dataTransfer.files[i].type.indexOf("image/") < 0) continue;
                        let file = e.dataTransfer.files[i];
                        this.readFile(file);
                    }
                }
                this.test = e;
            },
            dragOverHandler(e) {
                e.preventDefault();
            }
        }
    }
</script>

<style lang="scss" scoped>
    .dropzone {
        /*height: 96px;*/
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        border: dashed 1px gray;
        padding: 0 15px;
        margin: 15px;
        cursor: pointer;
        position: relative;
        /*background: white;*/
        height: 200px;
        /*border: 1px solid #e9e9e9;*/
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);

        &.active {
            border-color: green;
            background-color: #dddddd;
        }

        &__img-container {
            display: flex;

            svg {
                height: 80px;
                width: auto;
            }
        }

        &__text {
            text-align: center;
            font-size: 30px;
        }
    }
</style>