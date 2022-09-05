import React from 'react';
import ReactDOM from 'react-dom';

function Quiz() {
    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card">
                        <div className="card-header">
                            <nav data-role="ribbonmenu">
                                <ul className="tabs-holder">
                                    <li className="static"><a href="#">Static</a></li>
                                    <li><a href="#section-one">One</a></li>
                                    <li><a href="#section-two">Two</a></li>
                                    <li><a href="#section-three">Three</a></li>
                                </ul>

                                <div className="content-holder">
                                    <div className="section" id="section-one">
                                        <p className="p-4">Section one</p>
                                    </div>
                                    <div className="section" id="section-two">
                                        <p className="p-4">Section two</p>
                                    </div>
                                    <div className="section" id="section-three">
                                        <p className="p-4">Section three</p>
                                    </div>
                                </div>
                            </nav>
                        </div>

                        <div className="card-body">I'm an example component!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Quiz;

if (document.getElementById('showContainer')) {
    ReactDOM.render(<Quiz/>, document.getElementById('showContainer'));
}
